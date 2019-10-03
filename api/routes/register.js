const saltRounds = 10;
const Boom = require('boom');
const Joi = require("joi")
const mailer = require("../backend/mailer")
const bcrypt = require('bcryptjs')
const uuidv4 = require('uuid/v4');
const config = require('../util/config')
const JWT = require('jsonwebtoken');



module.exports = {
  method: ['POST'],
  path: '/api/users/register',
    config: { auth: false },
  handler: async (request, h) => {
    const pool = request.mysql.pool


      const hPayload = { ...request.payload }


      let id = uuidv4();
      try {


             let user = hPayload
             const salt = bcrypt.genSaltSync(10);
             const hash = bcrypt.hashSync(hPayload.password, salt);
              delete user.password
             const token = JWT.sign(JSON.stringify(user), config.getSecret())
             if (token !== "") {
               await pool.query(`INSERT INTO users(id, name, email, password, user_group_id, verifykey)
                           VALUES (?, ?, ?, ?, '3', ?)`, [id, hPayload.name, hPayload.email, hash, token])
                   .then(() => mailer.sendmail(token, hPayload.email))

             }


        return {code: 200, message: " registered user "}


      } catch (e) {
        if (e.code === "ER_DUP_ENTRY") {
          return h.response({code: 400, error: 'email already exists.'}).code(200)
        }else{
          return h.response({code: 500, error: 'server error.'})
        }
      }

    }

  }


