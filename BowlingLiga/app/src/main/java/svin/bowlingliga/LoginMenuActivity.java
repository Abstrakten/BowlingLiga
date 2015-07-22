package svin.bowlingliga;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.StringRequest;

import java.lang.reflect.Method;
import java.util.HashMap;
import java.util.Map;


public class LoginMenuActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login_menu);


        Button LoginButton = (Button)findViewById(R.id.LoginButton);
        LoginButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(LoginMenuActivity.this, BowlingLeagueStartActivity.class);

                CheckCredentials(intent);
            }
        });

        Button NewUserButton = (Button)findViewById(R.id.newUserButton);
        NewUserButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(LoginMenuActivity.this, RegisterNewUserActivity.class);

                startActivityForResult(intent, 1);
            }
        });
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_login_menu, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {

        if (requestCode == 1) {
            if(resultCode == RESULT_OK){
                ((EditText) findViewById(R.id.LoginName)).setText(data.getStringExtra("name"));
                ((EditText) findViewById(R.id.PassName)).setText(data.getStringExtra("pass"));

                Intent intent = new Intent(LoginMenuActivity.this, BowlingLeagueStartActivity.class);

                CheckCredentials(intent);

            }
        }
    }//onActivityResult

    public void CheckCredentials(final Intent intent){
        final String URL = "http://beer.mokote.dk/resources/api/authUser.php";
        // Post params to be sent to the server




        // TODO make not stringRequest, but JSONRequest (perhaps)
        StringRequest sr = new StringRequest(Request.Method.POST, URL, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                if(!response.equals("Username and/or password combination does not exist.")) {
                    System.out.println(response);
                    intent.putExtra("userinfo", response);
                    intent.putExtra("username", ((EditText) findViewById(R.id.LoginName)).getText().toString());
                    intent.putExtra("password", ((EditText) findViewById(R.id.PassName)).getText().toString());
                    startActivity(intent);
                }else{
                    AlertDialog.Builder dlgAlert  = new AlertDialog.Builder(LoginMenuActivity.this);
                    dlgAlert.setMessage("wrong password or username");
                    dlgAlert.setTitle("Error Message...");
                    dlgAlert.setPositiveButton("OK", null);
                    dlgAlert.setCancelable(true);
                    dlgAlert.create().show();

                    dlgAlert.setPositiveButton("Ok",
                            new DialogInterface.OnClickListener() {
                                public void onClick(DialogInterface dialog, int which) {

                                }
                            });
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                VolleyLog.e("Error:" + error.getMessage());
            }
        }){
            @Override
            protected Map<String,String> getParams(){
                Map<String,String> params = new HashMap<String, String>();
                params.put("username",((EditText) findViewById(R.id.LoginName)).getText().toString());
                params.put("password",((EditText) findViewById(R.id.PassName)).getText().toString());

                return params;
            }
// Why Override?
/*            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String,String> params = new HashMap<String, String>();
                params.put("Content-Type","application/x-www-form-urlencoded");
                return params;
            }*/
        };

        ApplicationController.getInstance().addToRequestQueue(sr);


/*        JsonObjectRequest req = new JsonObjectRequest(Request.Method.POST, URL, new JSONObject(params),
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        System.out.println(response);
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                VolleyLog.e("Error:" + error.getMessage(), error.getMessage());

            }
        });

        // add the request object to the queue to be executed
        ApplicationController.getInstance().addToRequestQueue(req);*/
    }
}
