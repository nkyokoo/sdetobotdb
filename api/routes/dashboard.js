module.exports = {
    method: 'GET',
    path: '/api/dashboard/get',
    config: {auth: 'jwt'},
    handler: async (request, h) => {
        try {
            const pool = request.mysql.pool
            let returnedObject = {};
            const [user_count] = await pool.query('SELECT COUNT(*) as user_count FROM users')
            const [products_count] = await pool.query('SELECT COUNT(*) as product_count FROM school_products')
            const [unit_count] = await pool.query('SELECT COUNT(*) as unit_count FROM product_unit_e')
            const [request_count] = await pool.query('SELECT COUNT(*) as request_count FROM wish_list WHERE godkendt = 0')
            returnedObject.total_users = user_count[0];
            returnedObject.total_products = products_count[0];
            returnedObject.total_product_units = unit_count[0];
            returnedObject.total_requests = request_count[0];

            return returnedObject
        } catch (e) {
            return e
        }

    }
}