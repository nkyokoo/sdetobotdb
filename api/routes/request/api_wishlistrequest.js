

module.exports = {
    method:'GET',
    path:'/api/request/get',
    config: {auth: 'jwt'},
    handler: async (request, h) => {
        const pool = request.mysql.pool

        try {
            const [rows, fields] = await pool.query('SELECT wish_list.id,wish_list.rerserved_date,wish_list.start_date,wish_list.end_date, sp.product_name,cpw.quantity, users.name FROM connection_product_wishlist as cpw INNER JOIN wish_list ON cpw.wish_list_id = wish_list.id INNER JOIN school_products as sp on sp.id = cpw.school_products_id INNER JOIN users on users.id = wish_list.user_id WHERE wish_list.godkendt = 0 order by wish_list.id,sp.product_name')
            return rows
        } catch (e) {
            return h.response({}).code(500);
        }
    }
};

