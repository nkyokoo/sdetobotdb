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
        await bcrypt.genSalt(10, function(err, salt) {
          bcrypt.hash(request.payload.password, salt, function(err, hash) {
            if(err){
              throw err;
            }
            let user = hPayload
            delete user.password
            const token = JWT.sign(JSON.stringify(user),config.getSecret())
            if(token !== ""){
               pool.query(`INSERT INTO users(id,name, email, password, user_group_id,verifykey) VALUES  ('${id}','${hPayload.name}','${hPayload.email}','${hash}','3','${token}')`);
              mailer.sendmail(token,hPayload.email)
            }

          });
        });
        return { code: 200, message: " registered user " };

      } catch (e) {
        console.log(e)
        return h.response({code:500, error:'server error'}).code(200)
      }

    }

  }


