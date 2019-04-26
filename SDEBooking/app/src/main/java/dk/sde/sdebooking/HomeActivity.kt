package dk.sde.sdebooking

import android.os.Bundle
import android.support.constraint.Group
import android.support.design.widget.Snackbar
import android.support.design.widget.NavigationView
import android.support.v4.view.GravityCompat
import android.support.v7.app.ActionBarDrawerToggle
import android.support.v7.app.AppCompatActivity
import android.util.Log
import android.view.Menu
import android.view.MenuItem
import android.view.View
import android.widget.EditText
import kotlinx.android.synthetic.main.activity_home.*
import kotlinx.android.synthetic.main.app_bar_home.*
import android.widget.TextView
import dk.sde.sdebooking.userdata.data
import kotlinx.android.synthetic.main.activity_home.view.*




class HomeActivity : AppCompatActivity(), NavigationView.OnNavigationItemSelectedListener {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_home)
        setSupportActionBar(toolbar)


        val toggle = ActionBarDrawerToggle(
            this, drawer_layout, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close
        )
        drawer_layout.addDrawerListener(toggle)
        toggle.syncState()

        nav_view.setNavigationItemSelectedListener(this)
        val parentView = nav_view.getHeaderView(0)

        val username = parentView.findViewById<TextView>(R.id.user_nav_title)
        val email = parentView.findViewById<TextView>(R.id.user_email_title)

        val data = data()
        val userdata = data.getData(this@HomeActivity)
        Log.d("user", userdata.getString("name"))
        username.text = userdata.getString("name")
        email.text = userdata.getString("email")
        val navigationView = findViewById<NavigationView>(R.id.nav_view)
        val nav_Menu = navigationView.menu

        if (userdata.getInt("user_group_id") == 1) {
            nav_Menu.setGroupEnabled(1,true)

        } else if (userdata.getInt("user_group_id") == 3) {

            nav_Menu.setGroupEnabled(0,true)

        }
    }

        override fun onBackPressed() {
            if (drawer_layout.isDrawerOpen(GravityCompat.START)) {
                drawer_layout.closeDrawer(GravityCompat.START)
            } else {
                super.onBackPressed()
            }
        }

        override fun onCreateOptionsMenu(menu: Menu): Boolean {
            // Inflate the menu; this adds items to the action bar if it is present.
            menuInflater.inflate(R.menu.home, menu)
            return true
        }

        override fun onOptionsItemSelected(item: MenuItem): Boolean {
            // Handle action bar item clicks here. The action bar will
            // automatically handle clicks on the Home/Up button, so long
            // as you specify a parent activity in AndroidManifest.xml.
            when (item.itemId) {
                R.id.action_settings -> return true
                else -> return super.onOptionsItemSelected(item)
            }
        }

        override fun onNavigationItemSelected(item: MenuItem): Boolean {
            // Handle navigation view item clicks here.
            when (item.itemId) {
                R.id.nav_camera -> {
                    // Handle the camera action
                }
                R.id.nav_gallery -> {

                }
                R.id.nav_slideshow -> {

                }
                R.id.nav_manage -> {

                }

            }

            drawer_layout.closeDrawer(GravityCompat.START)
            return true
        }
    }
