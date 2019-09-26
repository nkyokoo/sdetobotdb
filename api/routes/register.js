const saltRounds = 10;
const Boom = require('boom');
const Joi = require("joi")
const bcrypt = require('bcryptjs')
const uuidv4 = require('uuid/v4');



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
          bcrypt.hash(hPayload.password, salt, function(err, hash) {
            if(err){
              throw err;
            }
             pool.query(`INSERT INTO users(id,name, email, password, user_group_id) VALUES  ('${id}','${hPayload.name}','${hPayload.email}','${hash}','3')`);

          });
        });

        return { code: 200, message: " registered user " };

      } catch (e) {
        console.log(e)
        return h.response({code:500, error:'server error'}).code(200)
      }

    }

  }


