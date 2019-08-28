
module.exports = {
    method:'PUT',
    path:'/api/request/deny',
    config: {auth: 'jwt'},
    handler: async (request, h) => {
        const pool = request.mysql.pool

        try {
            let input = request.payload;
            const [rows, fields] = await pool.query('UPDATE `wish_list` SET godkendt = -1 WHERE id = ?',input.wishlistID)
            return "success";

        } catch (e) {
            return h.response({}).code(500);
        }
    }
};