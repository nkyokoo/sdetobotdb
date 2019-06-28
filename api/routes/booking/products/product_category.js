

module.exports = {
    method: 'GET',
    path: '/api/booking/category/get',
    config: { auth: 'jwt' },
    handler: async (request, h) => {
        const pool = request.mysql.pool

        try {
            let samletData = {};
            let sqlArr = [];
            sqlArr[0] ="SELECT id,type,nr FROM product_location_type_svf ";
            sqlArr[1] = "SELECT id,type,nr FROM product_location_type_thp";
            sqlArr[2] = "select * from category";
            sqlArr[3] = "SELECT id,room FROM `location_room`";
            sqlArr[4] = "SELECT id,name FROM supplier_company";
            sqlArr[5] = "SELECT id,company_name_short FROM school_address_short";
            for(let i = 0; i<sqlArr.length; i++) {
                const [rows] = await pool.query(sqlArr[i]);
                samletData["d"+i] = rows;
            };

            return samletData;
        } catch (e) {
            return h.response({}).code(500);
        }



    }
}