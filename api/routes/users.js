module.exports = [{
    method: 'GET',
    path: '/api/users/get',
    config: {auth: 'jwt'},
    handler: async (request, h) => {
        const pool = request.mysql.pool

        try {
            const [rows, fields] = await pool.query('SELECT users.id,name,email,user_rank FROM users INNER JOIN user_group ug on users.user_group_id = ug.id ORDER BY user_rank')
            return rows
        } catch (e) {
            console.log(e)
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
            console.log(e)
        }
    }
}]
