

module.exports = {
    method: 'GET',
    path: '/api/mail/category/get',
    config: { auth: false },
    handler: async (request, h) => {
        const pool = request.mysql.pool

        try {
            const [rows, fields] = await pool.query('select * from message_category')
            return rows
        } catch (e) {
            console.log(e)
        }



    }
}