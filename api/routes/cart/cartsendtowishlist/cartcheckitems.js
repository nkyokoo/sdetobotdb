

module.exports = {
    method: 'POST',
    path: '/api/booking/bookingsend/create',
    config: {
        auth: false,
    },

    handler: async (request, h) => {
        const pool = request.mysql.pool;


        try {
            let json = [];
            let payload = request.payload;
            let allproductsavailable = true;
            for (let i of payload){

                const [rows, fields] = await pool.query('SELECT COUNT(product_unit_e.id) as totalquantity FROM product_unit_e INNER JOIN school_products ON product_unit_e.products_id = school_products.id WHERE school_products.id = '+i.item+' AND product_unit_e.current_status_id = 1');
                let object = rows[0];

                if (i.quantity <= rows[0].totalquantity){
                    object.quantity  = i.quantity;
                    object.item = i.item;
                    object.available = allproductsavailable;
                    json.push(object);
                }else {
                    allproductsavailable = false;
                    object.quantity  = i.quantity;
                    object.item = i.item;
                    object.available = allproductsavailable;
                    json.push(object);
                }

            }
            // console.log(json);

            return json;
        } catch (e) {
            console.log(e)
        }



    }
}