

module.exports = {
    method: 'POST',
    path: '/api/booking/eventsforcart/display/create',
    config: { auth: false },
    handler: async (request, h) => {
        const pool = request.mysql.pool;


        try {
            let json = [];

            for(let i of request.payload)
            {
            const [rows, fields] = await pool.query('SELECT id,product_name,description,movable FROM school_products WHERE id = '+i.pid);
             let object  = rows[0];
                object.quantity = i.quantity;
            json.push(object);
            }


            return json;
        } catch (e) {
            console.log(e)
        }



    }
}