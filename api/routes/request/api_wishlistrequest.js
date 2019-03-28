

module.exports = {
    method:'GET',
    path:'/api/request/get',
    config: {auth: false},
    handler: async (request, h) => {
        const pool = request.mysql.pool

        try {
            const [rows, fields] = await pool.query('select * from wish_list where godkendt = 0')
            return rows
        } catch (e) {
            console.log(e)
        }
    }
}