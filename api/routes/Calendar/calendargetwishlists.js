module.exports = {
    method: 'GET',
    path: '/api/calendar/wishlists/get',
    config: {
        auth: 'jwt',
    },

    handler: async (request, h) => {
        const pool = request.mysql.pool;


        try {



            const [rows, fields] = await pool.query("SELECT wl.id, u.name , sp.product_name, cw.quantity, wl.start_date,wl.end_date FROM wish_list as wl  INNER JOIN connection_product_wishlist as cw ON cw.wish_list_id = wl.id inner JOIN school_products as sp on sp.id = cw.school_products_id INNER JOIN users as u on u.id = wl.user_id WHERE godkendt = 1 ORDER BY wl.id");
            let  prevWL = 0;
            let json = [];

            let object = {};

            for (let i of rows){


                if (prevWL === i.id){
                    let products = {
                        productname:i.product_name,
                        quantity:i.quantity
                    }
                    object.products.push(products);
                }else {
                    object = {};
                    json.push(object);
                    object.id  = i.id;
                    object.user = i.name;
                    object.startDate = i.start_date;
                    object.endDate = i.end_date;
                    object.products = [];
                    let products = {
                        productname:i.product_name,
                        quantity:i.quantity
                    }
                    object.products.push(products);
                    prevWL = i.id;

                }








            }

            // console.log(json);

            return json;
        } catch (e) {
            return h.response({}).code(500);
        }
    }



// samme id som sidste id
}