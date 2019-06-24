

module.exports = {
    method: 'GET',
    path: '/api/booking/category/get',
    config: { auth: 'jwt' },
    handler: async (request, h) => {
        const pool = request.mysql.pool

        try {
            let $sql = ''
            switch (request.query.type) {

                case 'category':
                    $sql ='select * from category'
                    break;
                case'company':
                    $sql = 'SELECT id,company_name_short FROM `school_address_short`  GROUP BY company_name_short'
                    break;

                case 'room':
                    $sql = "SELECT id,room FROM `location_room` group by room";

                    break;

                case 'svf':
                    $sql = "SELECT id,type,nr FROM product_location_type_svf GROUP BY type,nr";
                    break;

                case 'thp':
                    $sql = "SELECT id,type,nr FROM product_location_type_thp GROUP BY type,nr";
                    break;

                case 'company2':
                    $sql = "SELECT id,name FROM supplier_company";

                    break;


            }

            const [rows] = await pool.query($sql);
            return rows
        } catch (e) {
            console.log(e)
        }



    }
}