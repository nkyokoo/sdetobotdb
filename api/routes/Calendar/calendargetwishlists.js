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
            let prevWL = 0;
            let json = [];

            let object = {};

            for (let i of rows){


                if (prevWL === i.id){
                    object.description += "\nProduct: "+i.product_name+ "  Quantity: "+i.quantity;

                    // let products = {
                    //     productname:i.product_name,
                    //     quantity:i.quantity
                    // }
                    // object.description.push(products);
                }else {
                    object = {};
                    json.push(object);
                    object.id  = i.id;
                    object.title = i.name;
                    object.undertitle = "Fra "+ i.start_date + " til "+ i.end_date;
                    object.start = i.start_date;
                    object.end = i.end_date+"T23:59:00";
                    object.description = "Product: "+i.product_name+ "  Quantity: "+i.quantity;

                    // object.description = [];
                    // let products = {
                    //     productname:i.product_name,
                    //     quantity:i.quantity
                    // }
                    // object.description.push(products);
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