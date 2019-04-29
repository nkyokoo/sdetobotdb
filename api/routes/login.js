const cryptoFuncs = require("../backend/cryptoFuncs")
const Boom = require('boom');
const Joi = require("joi");



    module.exports = {
        method: ['POST'],
        path: '/api/users/login',
        config: { auth: false },
        handler: async (request, h) => {
            const pool = request.mysql.pool


            if (request.payload) {
                let payload = request.payload;
         const [rows, fields] = await pool.query('select * from users WHERE email = \'' + payload.email + '\'');
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
                                    message: "succesful"
                                }
                                let user = rows[0];
                                delete user.password
                                successful.user = [user]
                                return h.response(successful).code(200)
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

