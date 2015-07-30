package svin.bowlingliga;

import android.app.ActionBar;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.Response;
import com.android.volley.toolbox.JsonRequest;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.net.URL;
import java.util.HashMap;
import java.util.Map;

import svin.bowlingliga.Models.Player;


public class BowlingLeagueStartActivity extends AppCompatActivity {

    Player thisPlayer = new Player(9999,"JohnDoeFuckedUp",9999);

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_bowling_league_start);



        try {
            JSONObject jObj = new JSONObject(getIntent().getStringExtra("userinfo"));

            thisPlayer = new Player(
                    jObj.getInt("id"),
                    jObj.getString("username"),
                    jObj.getInt("rating"));
        } catch (JSONException e) {
            e.printStackTrace();
        }

        TextView MMR = (TextView) findViewById(R.id.RatingText);
        MMR.setText(String.valueOf(thisPlayer.getPlayerRating()));

        setTitle("Ølbowling Liga - " + thisPlayer.getPlayerName());





        Button regGameButton = (Button)findViewById(R.id.RegGameButton);
        regGameButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(BowlingLeagueStartActivity.this, RegisterScoreActivity.class);
                intent.putExtra("username", getIntent().getStringExtra("username"));
                intent.putExtra("password", getIntent().getStringExtra("password"));
                startActivity(intent);
            }
        });

        Button readRankingsButton = (Button) findViewById(R.id.ReadRankingsButton);
        readRankingsButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(BowlingLeagueStartActivity.this, ReadRankingsActivity.class);
                startActivity(intent);
            }
        });

        Button ReadMatchHistoryButton = (Button) findViewById(R.id.ReadMatchHistoryButton);
        ReadMatchHistoryButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(BowlingLeagueStartActivity.this, MatchHistoryActivity.class);
                intent.putExtra("id", thisPlayer.getId());
                startActivity(intent);
            }
        });

        Button ReadStatsButton = (Button) findViewById(R.id.ReadStatsButton);
        ReadStatsButton.setOnClickListener(new View.OnClickListener() {
           @Override
           public void onClick(View view) {
               Intent intent = new Intent(BowlingLeagueStartActivity.this, ReadStatsActivity.class);
               intent.putExtra("id", thisPlayer.getId());
               startActivity(intent);
           }
       });

        Button ReadRulesButton = (Button) findViewById(R.id.ReadRulesButton);
        ReadRulesButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(BowlingLeagueStartActivity.this, ReadRulesActivity.class);
                startActivity(intent);
            }
        });

    }

    @Override
    protected void onResume() {
        super.onResume();
        StringRequest req = new StringRequest(Request.Method.POST, "http://beer.mokote.dk/resources/api/getStats.php", new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {

                try {
                    JSONObject jObj = new JSONObject(response);
                    thisPlayer.setPlayerRating(jObj.getInt("rating"));
                    TextView MMR = (TextView) findViewById(R.id.RatingText);
                    MMR.setText(String.valueOf(thisPlayer.getPlayerRating()));
                    System.out.println("hello, is it me"); //Debugging

                } catch (JSONException e) {
                    e.printStackTrace();
                }


            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                VolleyLog.e("Error:" + error.getMessage());
            }
        }) {
            @Override
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<String, String>();
                params.put("id", String.valueOf(thisPlayer.getId()));

                return params;
            }
        };

        ApplicationController.getInstance().addToRequestQueue(req);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_liga_listen, menu);
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
}

