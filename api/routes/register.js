const cryptoFuncs = require("../backend/cryptoFuncs")
const Boom = require('boom');
const Joi = require("joi")


module.exports = {
  method: ['POST'],
  path: '/api/users/register',
    config: { auth: false },
  handler: async (request, h) => {
    const pool = request.mysql.pool


      const hPayload = { ...request.payload }

      const hashed_password = cryptoFuncs.encrypt(request.payload.password)

      hPayload.password = hashed_password;

      try {
        console.log(hPayload)
       await pool.query('INSERT INTO users(id,name, email, password, user_group_id) VALUES ' + '(\'\',\'' + hPayload.name + '\',\'' + hPayload.email + '\',\'' + hPayload.password + '\',\'3\')')
        return { code: 200, message: " registered user " };

      } catch (e) {
        console.log(e)
      }

    }

  }


