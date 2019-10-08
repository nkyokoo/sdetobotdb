const JWT = require('jsonwebtoken')
const config = require("../util/config")

module.exports = [{
    method: 'GET',
    path: '/api/users/get',
    config: {auth: 'jwt'},
    handler: async (request, h) => {
        const pool = request.mysql.pool

        try {
            const [rows, fields] = await pool.query('SELECT users.id,name,email,user_rank,disabled FROM users INNER JOIN user_group ug on users.user_group_id = ug.id ORDER BY user_rank')
            for(i of rows){
                if(i.disabled ===1){
                    i.disabled = "ja"
                }else{
                    i.disabled = "nej"
                }
            }
            return rows
        } catch (e) {
            return h.response({error: e.message}).code(500);
        }
    }
}, {
    method: 'GET',
    path: '/api/users/group/get',
    config: {auth: 'jwt'},
    handler: async (request, h) => {
        const pool = request.mysql.pool

        try {
            const [rows, fields] = await pool.query('SELECT * FROM user_group AS ug')
            return rows
        } catch (e) {
            return h.response(e).code(500);
        }
    }
}, {
    method: 'PATCH',
    path: '/api/users/verify',
    config: {auth: false},
    handler: async (request, h) => {
        const pool = request.mysql.pool

        try {
          await pool.query('UPDATE users SET users.verified = 1 WHERE email = ?',[request.payload.email])
            return h.response({code:200, message: 'verified user'})
        } catch (e) {
            return h.response(e).code(500);
        }
    }
}, {
    method: 'POST',
    path: '/api/users/verification/check',
    config: {auth: false},
    handler: async (request, h) => {
        const pool = request.mysql.pool

        try {
            const [rows, fields] = await pool.query('SELECT * FROM users WHERE verifykey = ?',[request.payload.key])

            if(rows.length !==0){
                if(rows[0].verified === 1){
                    return h.response({code:401, error: "already verified"})
                }else{
                    const keydata = JWT.verify(request.payload.key, config.getSecret());
                    console.log(keydata)
                    return h.response({code:200, data:keydata}).code(200)
                }
            }else{
                return h.response({code:400, error: 'invalid key'}).code(200)
            }


        } catch (e) {
            return h.response({code:500, error:e}).code(500);
        }
    }
}
]
