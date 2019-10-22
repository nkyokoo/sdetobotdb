module.exports = {
    method: 'POST',
    path: '/api/calendar/item/histories/get',
    config: {
        auth: 'jwt',
    },

    handler: async (request, h) => {
        const pool = request.mysql.pool;

        const [rows,fields] = await pool.query("SELECT u.name , cw.quantity, wl.start_date,wl.end_date FROM wish_list as wl  INNER JOIN connection_product_wishlist as cw ON cw.wish_list_id = wl.id inner JOIN school_products as sp on sp.id = cw.school_products_id INNER JOIN users as u on u.id = wl.user_id WHERE godkendt = 1 AND sp.id = ? ORDER BY wl.id",[request.payload.productID]);

        let json = [];

        let object = {};

        for (let i of rows){
                object = {};
                object.title =  i.quantity + " stk.";
                object.undertitle = "Fra "+ i.start_date + " til "+ i.end_date;
                object.start = i.start_date;
                object.end = i.end_date+"T23:59:00";
                object.description = "Navn: "+i.name;
                json.push(object);

        }

        return json;
    }
}