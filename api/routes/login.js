const cryptoFuncs = require("../backend/cryptoFuncs")
const Boom = require('boom');
const Joi = require("joi");



    module.exports = {
        method: ['POST'],
        path: '/api/users/login',
        config: { auth: false },
        handler: async (request, h) => {
            const pool = request.mysql.pool
            let payload = request.payload;
            const [rows, fields] = await pool.query('select * from users WHERE email = \'' + payload.email + '\'');


            let decrypted;

            try {
                decrypted = cryptoFuncs.decrypt(rows[0].password)
            } catch (e) {
                console.log(e)
            }

            if (decrypted === payload.password) {
              let sendingUser = rows[0];
              delete sendingUser.password
                return sendingUser

            } else {
                return { code: 401, error: "password incorrect" }
            }
        }
    }

