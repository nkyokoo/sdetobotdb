

module.exports = {
    method: 'POST',
    path: '/api/booking/eventsforcart/productinstock/get',
    config: { auth: 'jwt' },
    handler: async (request, h) => {
        const pool = request.mysql.pool;


        try {
            let pid = request.payload;


            const [rows, fields] = await pool.query('SELECT COUNT(id) as quantity FROM `product_unit_e` WHERE products_id = '+ pid.pid +' AND current_status_id = 1');

            return rows;

        } catch (e) {
            console.log(e)
        }



    }
}