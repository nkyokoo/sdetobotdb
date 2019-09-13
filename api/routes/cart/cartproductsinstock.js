

module.exports = {
    method: 'POST',
    path: '/api/booking/eventsforcart/productinstock/get',
    config: { auth: 'jwt' },
    handler: async (request, h) => {
        const pool = request.mysql.pool;


        try {
            let pid = request.payload;


            const [rows, fields] = await pool.query('SELECT COUNT(pe.products_id) - ( SELECT IFNULL((SELECT SUM(cw1.quantity) FROM connection_product_wishlist as cw1 INNER JOIN wish_list as wl1 ON wl1.id = cw1.wish_list_id WHERE (wl1.start_date <= ?) and (wl1.end_date >= ?) AND wl1.godkendt BETWEEN 0 AND 1 AND cw1.school_products_id = sp.id GROUP BY cw1.school_products_id ),0) as quantity ) as quantity  FROM school_products as sp INNER JOIN product_unit_e as pe ON sp.id = pe.products_id  WHERE  pe.current_status_id = 1 AND sp.id = ? GROUP BY pe.products_id'
                ,[pid.edate,pid.sdate,pid.pid]);

            return rows;

        } catch (e) {
            return h.response({}).code(500);
        }



    }
}