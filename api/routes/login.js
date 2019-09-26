const JWT = require('jsonwebtoken');
const Boom = require('boom');
const Joi = require("joi");
const config = require('../util/config')
const bcrypt = require('bcryptjs')


module.exports = {
    method: ['POST'],
    path: '/api/users/login',
    config: {auth: false},
    handler: async (request, h) => {
        const pool = request.mysql.pool


        if (request.payload) {
            let payload = request.payload;
            const [rows, fields] = await pool.query('select * from users WHERE email = ?', [payload.email]);
            if(rows[0].verified === 0){
              return  h.response({ errorid:"USER_NOT_ACTIVATED", code:403,error:'Din konto er ikke verificeret, se din inbox for mail!'})
            }
            if(rows[0].disabled === 1){
               return h.response({error:"denne konto er deaktiveret, hvis det er en fejl så kontakt IT OG DATA SKP"})

            }
            if (rows.length !== 0) {

                try {
                    if (bcrypt.compareSync(payload.password, rows[0].password)) {

                        let successful = {
                            code: 200,
                            message: "successful"
                        }

                        let user = rows[0];
                        const token = JWT.sign(JSON.stringify(user), config.getSecret());
                        delete user.password
                        successful.user = [user]
                        user.token = token;

                        return h.response(successful).code(200)

                    } else {
                        return h.response({code: 401, error: "password incorrect"}).code(200)

                    }
                } catch (e) {
                    console.log(e)
                    return "error"
                }
            } else {
                return h.response({code: 401, error: "email doesn't exist"}).code(200)

            }

        } else {
            return {code: 400, error: "fill something in"}
        }
    }
}

