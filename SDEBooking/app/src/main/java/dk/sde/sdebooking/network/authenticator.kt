package dk.sde.sdebooking.network

import android.app.Activity
import android.content.Context
import android.os.Build
import android.support.annotation.RequiresApi
import java.io.*
import java.net.HttpURLConnection
import java.net.URL
import java.nio.charset.StandardCharsets
import org.json.JSONException
import org.json.JSONObject
import android.widget.Toast






class authenticator {
    @RequiresApi(Build.VERSION_CODES.N)
    fun login(email: String, password: String, applicationContext: Context){
        val credentials = JSONObject()
        try {
            credentials.put("email", email)
            credentials.put("password", password)


        } catch (e: JSONException) {
            e.printStackTrace()
        }

        val serverURL: String = "http://172.16.5.145:8000/api/users/login"
        val url = URL(serverURL)
        val connection = url.openConnection() as HttpURLConnection
        connection.requestMethod = "POST"
        connection.connectTimeout = 300000
        connection.connectTimeout = 300000
        connection.doOutput = true

        val postData: ByteArray = credentials.toString().toByteArray(StandardCharsets.UTF_8)

        connection.setRequestProperty("charset", "utf-8")
        connection.setRequestProperty("Content-lenght", postData.size.toString())
        connection.setRequestProperty("Content-Type", "application/json")

        try {
            val outputStream: DataOutputStream = DataOutputStream(connection.outputStream)
            outputStream.write(postData)
            outputStream.flush()
        } catch (exception: Exception) {

        }

        if (connection.responseCode != HttpURLConnection.HTTP_OK && connection.responseCode != HttpURLConnection.HTTP_CREATED) {
            try {


                val reader: BufferedReader = BufferedReader(InputStreamReader(connection.inputStream))
                val output: String = reader.readLine()

            } catch (exception: Exception) {
                throw Exception("Exception while push the notification  $exception.message")
            }
        }else{
            val reader: BufferedReader = BufferedReader(InputStreamReader(connection.inputStream))
            val output: String = reader.readLine()
            val response = JSONObject(output)
            val text = response.getString("error")
            val duration = Toast.LENGTH_SHORT

                val toast = Toast.makeText(applicationContext, text, duration)


        }




    }
}
