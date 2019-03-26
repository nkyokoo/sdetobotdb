
module.exports = {
    method: 'POST',
    path: '/api/test123',
    config: { auth: false },
    handler: async (request, h) => {
        const pool = request.mysql.pool;


        try {
            let i = request.query.user;

                const [rows, fields] = await pool.query('INSERT INTO wish_list(`godkendt`, `user_id`) VALUES (0,'+i+')');



            console.log(rows.insertId);

        } catch (e) {
            console.log(e)
        }



    }
}