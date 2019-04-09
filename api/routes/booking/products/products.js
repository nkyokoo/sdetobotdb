module.exports = [
    {
        method: 'post',
        path: '/api/booking/products/create',
        config: {auth: false},
        handler: async (request, h) => {
            const pool = request.mysql.pool;

            try {

                switch (request.query.type) {
                    case 'lokale':
                        const [rows,fields] = pool.query("INSERT INTO `location_room` (`room`) VALUES ('"+payload.lokale+"')");
                        break;
                }

            } catch (e) {
                console.log(e)
            }
        }
    },
    {
        method: 'get',
        path: '/api/booking/products/get',
        config: {auth: false},
        handler: async (request, h) => {
            const pool = request.mysql.pool;

            try {

                switch (request.query.type) {
                    case 'lokale':
                      const [rows,fields] = pool.query("SELECT id FROM location_room WHERE location_room.id = '" + payload.lokale +"' OR location_room.room = '"+payload.lokale+"'")
                        return rows
                }

            } catch (e) {
                console.log(e)
            }
        }
    }
]