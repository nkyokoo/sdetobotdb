

module.exports = {
    method: 'GET',
    path: '/api/booking/category/get',
    config: { auth: false },
    handler: async (request, h) => {
        const pool = request.mysql.pool

        try {
            let $sql = ''
            switch (request.query.type) {

                case 'category':
                    $sql ='select * from category'
                    const [category] = await pool.query($sql)
                    return category
                case'company':
                    $sql = 'SELECT id,company_name_short FROM `school_address_short`  GROUP BY company_name_short'
                    const [company_short] = await pool.query($sql)
                    return company_short
                case 'room':
                    $sql = "SELECT id,room FROM `location_room` group by room";
                    const[room] = await pool.query($sql)
                  return room

                case 'svf':
                    $sql = "SELECT id,type,nr FROM product_location_type_svf GROUP BY type,nr";
                    const [svf] = await pool.query($sql)
                    return svf
                case 'thp':
                    $sql = "SELECT id,type,nr FROM product_location_type_thp GROUP BY type,nr";
                    const [thp] = await pool.query($sql)
                    return thp
                case 'company2':
                    $sql = "SELECT id,name FROM supplier_company";
                    [rows] = await pool.query($sql)
                    return rows


            }

        } catch (e) {
            console.log(e)
        }



    }
}