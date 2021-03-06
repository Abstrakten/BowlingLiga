package svin.bowlingliga;

import android.app.AlertDialog;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.EditText;
import android.widget.TextView;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;


public class ReadStatsActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_read_stats);

        setTitle("Statistik");

        StringRequest req = new StringRequest(Request.Method.POST, "http://beer.mokote.dk/resources/api/getStats.php", new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                System.out.println(response); //debugging
                JSONObject jObj;

                try {
                    jObj = new JSONObject(response);

                    TextView wins = (TextView)findViewById(R.id.wins);
                    wins.setText(jObj.getString("won_games"));

                    TextView losses = (TextView)findViewById(R.id.losses);
                    losses.setText(jObj.getString("lost_games"));

                    double winsNum = jObj.getInt("won_games");
                    double lossesNum = jObj.getInt("lost_games");
                    int winrateNum = (int)((winsNum / (winsNum+lossesNum))*100);

                    TextView winrate = (TextView)findViewById(R.id.winRate);
                    winrate.setText(String.valueOf(winrateNum)+"%");

                    TextView beers = (TextView)findViewById(R.id.beersDrunk);
                    beers.setText(jObj.getString("beersdrunk"));



                } catch (JSONException e) {
                    e.printStackTrace();
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
                params.put("id",String.valueOf(getIntent().getIntExtra("id", 0)));

                return params;
            }
        };

        ApplicationController.getInstance().addToRequestQueue(req);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_read_stats, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case android.R.id.home:
                finish();
                return true;

            default:
                return super.onOptionsItemSelected(item);
        }
    }
}
