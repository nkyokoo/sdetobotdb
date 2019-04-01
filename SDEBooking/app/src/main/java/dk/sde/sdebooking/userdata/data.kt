package dk.sde.sdebooking.userdata

import android.content.Context
import android.util.Log
import org.json.JSONArray
import org.json.JSONObject
import java.io.FileInputStream

class data {

    fun saveData(data: JSONObject, context: Context){
        val filename = "userdata"
        val fileContents =  data.toString()
        context.openFileOutput(filename, Context.MODE_PRIVATE).use {
            it.write(fileContents.toByteArray())
        }
    }
    fun isLoggedIn(context:Context) : Boolean{
        val file = context.getFileStreamPath("userdata");
        if (file.exists()){
            Log.d("exits", file.absolutePath)
            return true
        }else{
            return false
        }

    }
    fun getData(context:Context) : JSONObject {
        val file = context.openFileInput("userdata")
        val string = file.bufferedReader().use { it.readText() }
        val json = JSONObject(string)

        return json
    }

}