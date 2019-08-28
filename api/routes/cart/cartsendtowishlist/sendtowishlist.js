
module.exports = {
    method: 'POST',
    path: '/api/booking/bookingsend/wishlist/create',
    config: { auth: 'jwt'},
    handler: async (request, h) => {
        const pool = request.mysql.pool;

        try {
                let i = request.payload;
                console.log(i);

                const [rows,fields] = await pool.query("INSERT INTO `wish_list`(`id`, `rerserved_date`, `start_date`, `end_date`, `reminder_date`, `godkendt`, `user_id`) VALUES (?,?,?,?,?,?,?)",[0,i.user]);
           // console.log(rows.insertId);
            return rows.insertId;
        } catch (e) {
            console.log(e)
            return h.response('err').code(500)
        }



    }
}