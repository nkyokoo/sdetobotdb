module.exports = {
    method: 'GET',
    path: '/api/users/get',
    config: {auth: false},
    handler: async (request, h) => {
        const pool = request.mysql.pool

        try {
            const [rows, fields] = await pool.query('SELECT users.id,name,email,user_rank FROM users INNER JOIN user_group ug on users.user_group_id = ug.id ORDER BY user_rank')
            return rows
        } catch (e) {
            console.log(e)
        }
    }
}