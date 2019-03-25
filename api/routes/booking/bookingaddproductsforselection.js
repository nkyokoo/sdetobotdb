

module.exports = {
    method: 'get',
    path: '/api/booking/bookinglist/get',
    config: { auth: false },
    handler: async (request, h) => {
        const pool = request.mysql.pool;

        try {
                const [rows, fields] = await pool.query('SELECT school_products.id,school_products.product_name,school_products.description,school_products.movable, COUNT(product_unit_e.products_id) as quantity\n' +
                    '                    FROM product_unit_e\n' +
                    '                    INNER JOIN school_products\n' +
                    '                    ON school_products.id = product_unit_e.products_id\n' +
                    '                    WHERE product_unit_e.current_status_id = 1                    \n' +
                    '                    GROUP BY product_unit_e.products_id');



                return rows;
        } catch (e) {
            console.log(e)
        }
    }
}