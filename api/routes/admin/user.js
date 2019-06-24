const cryptoFuncs = require("../../backend/cryptoFuncs")
const Boom = require('boom');
const Joi = require("joi")
const uuidv4 = require('uuid/v4');

module.exports = {
    method: 'POST',
    path: '/api/admin/user/create',
    config: {auth: 'jwt'},
    handler: async (request, h) => {
        let credentials = request.auth.credentials;
       if(credentials.user_group_id !== 1){
           return h.response({'error': 'Your token can\'t be used to access this route'}).code(401)
       }
       if(!request.payload){
           return h.response({error: 'payload can\'t be empty'}).code(400)
       }
             const pool = request.mysql.pool
             const hPayload = { ...request.payload }
              const [count] = await pool.query("SELECT email as count FROM users WHERE email = ?",[hPayload.email])
            console.log(count)
            if(count.length !== 0){
                return h.response({ code: 400, message: " an user with this email already exists!" }).code(400)
            }

             const hashed_password = cryptoFuncs.encrypt(request.payload.password)
             hPayload.password = hashed_password;
             let id = uuidv4()
             try {

                await pool.query("INSERT INTO users(id,name, email, password, user_group_id) VALUES  (?,?,?,?,?)",[ id , hPayload.name , hPayload.email , hPayload.password ,hPayload.rank])
                 return h.response({ code: 200, message: " bruger registeret " }).code(200)

             } catch (e) {
                 console.log(e)
                 return h.response({ code: 500, message: e.message }).code(500)
             }

    }

}