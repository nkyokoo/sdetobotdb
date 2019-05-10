module.exports = [
// create methods
    {
        method: 'post',
        path: '/api/booking/products/location/create',
        config: {auth: false},
        handler: async (request, h) => {
            const pool = request.mysql.pool;

            try {

               const [rows,fields] = await pool.query("INSERT INTO location_room (room) VALUES ('"+payload.lokale+"')");
                return h.response(rows).code(200)


            } catch (e) {
                  console.log(e)
               return h.response({'error': e}).code(500)
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

                 const [rows,fields] = await pool.query("INSERT INTO product_location_type_svf (type,nr) VALUES ('"+request.payload.type+"','"+request.payload.number+"')");
                return h.response(rows).code(200)

            } catch (e) {
                  console.log(e)
                return h.response({'error': e}).code(500)
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
                const [rows,fields] = await pool.query("INSERT INTO product_location_type_thp (type,nr) VALUES ('"+request.payload.type+"','"+request.payload.nr+"')");
                return h.response(rows).code(200)


            } catch (e) {
                  console.log(e)
                return h.response({'error': e}).code(500)
            }
        }
    },
    {
        method: 'post',
        path: '/api/booking/products/address/create',
        config: {auth: false},
        handler: async (request, h) => {
            const pool = request.mysql.pool;

            try {
                const [rows,fields] = await pool.query("INSERT INTO product_school_address (school_name,city,zip_code,address) VALUES ('"+request.payload.schoolname+"','"+request.payload.city+"','"+request.payload.address+"')");
                const [rows2,fields3] =await pool.query("INSERT INTO school_address_short (company_name_short,product_school_address_id) VALUES ('"+request.payload.short+"','"+rows.product_school_address_id+"')");
                const returningjson = [rows,rows2]
                return h.response(returningjson).code(200)


            } catch (e) {
                console.log(e)
                return h.response({'error': e}).code(500)
            }
        }
    },
    {
        method: 'post',
        path: '/api/booking/products/suppliers/create',
        config: {auth: false},
        handler: async (request, h) => {
            const pool = request.mysql.pool;
            try {

                const [rows, fields] =  await pool.query("INSERT INTO supplier_company (name,address,call_number) values (''"+request.payload.name+"','"+request.payload.address+"','"+request.payload.number+"')");
                return rows

            } catch (e) {
                console.log(e)
                return h.response().code(500)
            }
        }
    },
    {
        method: 'post',
        path: '/api/booking/products/create',
        config: {auth: false},
        handler: async (request, h) => {
            const pool = request.mysql.pool;
            try {

                await pool.query("INSERT INTO school_products (product_name,  movable , description,school_name_short_id, category_id, supplier_company_id)" +
                    " VALUES ('"+request.payload.product_name+"','"+request.payload.movable+"','"+request.payload.description+"','"+request.payload.school_name_short_id+"'," +
                    "'"+request.payload.category_id+"','"+request.payload.supplier_company_id+"')");
                return  h.response({'unit':'created'}).code(200)


            } catch (e) {
                console.log(e)
                return h.response({'error': e}).code(500)
            }
        }
    },
    {
        method: 'post',
        path: '/api/booking/products/units/create',
        config: {auth: false},
        handler: async (request, h) => {
            const pool = request.mysql.pool;
            try {

                 await pool.query("INSERT INTO product_unit_e (unit_number, current_status_id, products_id,location_room_id,product_location_type_svf_id,product_location_type_thp_id) VALUES ('"+request.payload.unit_number+"', 1, '"+request.payload.products_id+"', '"+request.payload.location_room_id+"', '"+request.payload.product_location_type_svf_id+"', '"+request.product_location_type_thp_id.products_id+"')")
                h.response({'unit':'created'}).code(200)
            } catch (e) {
                console.log(e)
                return h.response({'error': e}).code(500)
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

                const [rows, fields] = await pool.query("SELECT id FROM location_room WHERE location_room.id = '" + request.payload.lokale + "' OR location_room.room = '" + request.payload.lokale + "'")
                console.log(rows)
                return rows

            } catch (e) {
                  console.log(e)
               return h.response({'error': e}).code(500)
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

                const [rows, fields] = await pool.query("SELECT id FROM product_location_type_svf WHERE id = '" + request.payload.id + "' or type = '" + request.payload.type + "' and nr =" + request.payload.number+ "'");
                return rows

            } catch (e) {
                  console.log(e)
               return h.response({'error': e}).code(500)
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

                const [rows, fields] = await pool.query("SELECT id FROM product_location_type_svf WHERE id = '" + request.payload.id + "' or type ='"+ request.payload.id + "' and nr = " + request.payload.number+ "'");
                return rows

            } catch (e) {
                  console.log(e)
               return h.response({'error': e}).code(500)
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
               return h.response({'error': e}).code(500)
            }
        }
    },
    {
        method: 'post',
        path: '/api/booking/products/category/get',
        config: {auth: false},
        handler: async (request, h) => {
            const pool = request.mysql.pool;
            try {

                const [rows, fields] =  await pool.query("SELECT id FROM supplier_company WHERE id = '"+request.payload.id+"'");
                console.log(rows)
                return rows

            } catch (e) {
                console.log(e)
                return h.response({'error': e}).code(500)
            }
        }
    },
    {
        method: 'post',
        path: '/api/booking/products/suppliers/get',
        config: {auth: false},
        handler: async (request, h) => {
            const pool = request.mysql.pool;
            try {

                const [rows, fields] =  await pool.query("SELECT id FROM supplier_company WHERE id = '" + request.payload.id+"'");
                return rows

            } catch (e) {
                console.log(e)
                return h.response({'error': e}).code(500)
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

                const [rows, fields] =  await pool.query("SELECT * FROM school_products INNER JOIN category AS c ON c.id = category_id INNER JOIN supplier_company AS s ON s.id = supplier_company_id INNER JOIN product_school_address as sch on sch.id = school_name_short_id");
                return rows

            } catch (e) {
                  console.log(e)
               return h.response({'error': e}).code(500)
            }
        }
    },
    {
        method: 'get',
        path: '/api/booking/products/catalog/get',
        config: {auth: false},
        handler: async (request, h) => {
            const pool = request.mysql.pool;
            try {

                const [rows, fields] = await pool.query('SELECT school_products.id,school_products.product_name,school_products.description,school_products.movable, COUNT(product_unit_e.products_id) as quantity FROM product_unit_e INNER JOIN school_products ON school_products.id = product_unit_e.products_id WHERE product_unit_e.current_status_id = 1 GROUP BY product_unit_e.products_id');

                return rows;

            } catch (e) {
                console.log(e)
                return h.response({'error': e}).code(500)
            }
        }
    }
]