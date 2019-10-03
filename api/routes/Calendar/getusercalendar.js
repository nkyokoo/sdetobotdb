module.exports = {
    method: 'POST',
    path: '/api/calendar/user/wishlists/get',
    config: {
        auth: 'jwt',
    },

    handler: async (request, h) => {
        const pool = request.mysql.pool;
        const [rows,fields] = await pool.query("SELECT wl.id, u.name , sp.product_name, cw.quantity, wl.start_date,wl.end_date FROM wish_list as wl  INNER JOIN connection_product_wishlist as cw ON cw.wish_list_id = wl.id inner JOIN school_products as sp on sp.id = cw.school_products_id INNER JOIN users as u on u.id = wl.user_id WHERE godkendt = 1 AND wl.user_id = ? ORDER BY wl.id",[request.payload.userId]);

        let prevWL = 0;
        let json = [];

        let object = {};

        for (let i of rows){


            if (prevWL === i.id){

                object.description += "\nProdukt: "+i.product_name+ "  Kvantitet: "+i.quantity;
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
                object.description = "Produkt: "+i.product_name+ "  Kvantitet: "+i.quantity;

                // object.description = [];
                // let products = {
                //     productname:i.product_name,
                //     quantity:i.quantity
                // }
                // object.description.push(products);
                prevWL = i.id;

            }


        }

        return json;
    }
}