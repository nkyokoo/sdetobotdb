module.exports = [
// create methods
    {
        method: 'post',
        path: '/api/booking/products/location/create',
        config: {auth: false},
        handler: async (request, h) => {
            const pool = request.mysql.pool;

            try {

                const [rows,fields] = await pool.query("INSERT INTO `location_room` (`room`) VALUES ('"+payload.lokale+"')");
                return rows


            } catch (e) {
                console.log(e)
            }
        }
    },
    {
        method: 'post',
        path: '/api/booking/products/svf/create',
        config: {auth: false},
        handler: async (request, h) => {
            const pool = request.mysql.pool;

            try {

                const [rows,fields] = await pool.query("INSERT INTO `product_location_type_svf` (`type`,nr) VALUES ('"+request.payload.type+"','"+request.payload.number+"')");
                return rows

            } catch (e) {
                console.log(e)
            }
        }
    },
    {
        method: 'post',
        path: '/api/booking/products/thp/create',
        config: {auth: false},
        handler: async (request, h) => {
            const pool = request.mysql.pool;

            try {
                const [rows,fields] = await pool.query("INSERT INTO `product_location_type_thp` (`type`,nr) VALUES ('"+request.payload.type+"','"+request.payload.nr+"')");
                return rows

            } catch (e) {
                console.log(e)
            }
        }
    },
  //get methods
    {
        method: 'post',
        path: '/api/booking/products/location/get',
        config: {auth: false},
        handler: async (request, h) => {
            const pool = request.mysql.pool;

            try {

                const [rows, fields] = await pool.query("SELECT id FROM location_room WHERE location_room.id = '" + payload.lokale + "' OR location_room.room = '" + payload.lokale + "'")
                return rows

            } catch (e) {
                console.log(e)
            }
        }
    },
    {
        method: 'post',
        path: '/api/booking/products/svf/get',
        config: {auth: false},
        handler: async (request, h) => {
            const pool = request.mysql.pool;

            try {

                const [rows, fields] = await pool.query("SELECT id FROM product_location_type_svf WHERE id = '" + request.payload.id + "' or type = '" + request.payload.type + "' and nr =" + request.payload.number);
                return rows

            } catch (e) {
                console.log(e)
            }
        }
    },
    {
        method: 'post',
        path: '/api/booking/products/thp/get',
        config: {auth: false},
        handler: async (request, h) => {
            const pool = request.mysql.pool;

            try {

                const [rows, fields] = await pool.query("SELECT id FROM product_location_type_svf WHERE id = '" + request.payload.id + "' or type ='"+ request.payload.id + "' and nr = " + request.payload.number);
                return rows

            } catch (e) {
                console.log(e)
            }
        }
    },
    {
        method: 'post',
        path: '/api/booking/products/address/get',
        config: {auth: false},
        handler: async (request, h) => {
            const pool = request.mysql.pool;
            try {

                const [rows, fields] =  await pool.query("SELECT school_address_short.id FROM school_address_short INNER JOIN product_school_address ON school_address_short.product_school_address_id = '" + request.payload.id + "'");
                return rows

            } catch (e) {
                console.log(e)
            }
        }
    },
    {
        method: 'get',
        path: '/api/booking/products/get',
        config: {auth: false},
        handler: async (request, h) => {
            const pool = request.mysql.pool;
            try {

                const [rows, fields] =  await pool.query("SELECT * FROM `school_products` INNER JOIN category AS c on c.id = category_id INNER join supplier_company as s on s.id = supplier_company_id INNER JOIN product_school_address as sch on sch.id = school_name_short_id");
                return rows

            } catch (e) {
                console.log(e)
               return h.response("error").code(500)
            }
        }
    }
]