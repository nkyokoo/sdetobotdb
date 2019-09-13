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
},
    {
    method: 'GET',
    path: '/api/users/group/get',
    config: {auth: 'jwt'},
    handler: async (request, h) => {
        const pool = request.mysql.pool

        try {
            const [rows, fields] = await pool.query('SELECT * FROM user_group AS ug')
            return rows
        } catch (e) {
            return h.response({}).code(500);
        }
    }
}]
