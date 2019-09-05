const cryptoFuncs = require("../backend/cryptoFuncs")
const JWT         = require('jsonwebtoken');
const Boom = require('boom');
const Joi = require("joi");
const config = require('../util/config')


    module.exports = {
        method: ['POST'],
        path: '/api/users/login',
        config: { auth: false },
        handler: async (request, h) => {
            const pool = request.mysql.pool


            if (request.payload) {
                let payload = request.payload;
         const [rows, fields] = await pool.query('select * from users WHERE email = ? AND NOT disabled = 1',[payload.email]);
                        if (rows.length !== 0) {
                            let decrypted;
                            try {
                                decrypted = cryptoFuncs.decrypt(rows[0].password)
                            } catch (e) {
                                console.log(e)
                            }

                            if (decrypted === payload.password) {
                                let successful = {
                                    code: 200,
                                    message: "successful"
                                }
                               try{
                                let user = rows[0];
                                const token = JWT.sign(JSON.stringify(user),config.getSecret());
                                delete user.password
                                successful.user = [user]
                                   user.token = token;

                                   return h.response(successful).code(200)

                               }catch (e) {
                                    console.log(e)
                                   return h.response("error").code(500)

                               }
                            } else {
                                return h.response({code: 401, error: "password incorrect"}).code(401)
                            }
                        } else {
                            return h.response({code: 401, error: "email doesn't exist"}).code(401)

                        }

            }else{
                return {code:400, error: "fill something in"}
            }
        }
    }

