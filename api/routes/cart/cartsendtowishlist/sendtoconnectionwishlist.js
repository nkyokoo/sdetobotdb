module.exports = {
    method: 'POST',
    path: '/api/booking/bookingsend/connection/create',
    config: {auth: 'jwt' },
    handler: async (request, h) => {
        const pool = request.mysql.pool;


        try {
            let payload = request.payload;
      //      console.log(payload);
            for (let i of payload){
              //  console.log(i.wishlistid+','+i.productid+','+i.quantity);
                const [rows, fields] = await pool.query("INSERT INTO `connection_product_wishlist`(`wish_list_id`, `school_products_id`, `quantity`) VALUES (?,?,?)",[i.wishlistid,i.productid,i.quantity])
            }
            return "succes";
        } catch (e) {
            return "err"
        }



    }
}