package svin.bowlingliga;

import android.app.AlertDialog;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.TextView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import svin.bowlingliga.ListAdapter.MatchHistoryListAdapter;
import svin.bowlingliga.ListAdapter.PlayerListAdapter;
import svin.bowlingliga.Models.Match;
import svin.bowlingliga.Models.Player;


public class MatchHistoryActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_match_history);

        final ListView historyList = (ListView) findViewById(R.id.matchHistoryListView);

        SimpleDateFormat formatter = new SimpleDateFormat("dd-MM-yyyy");

        Calendar cal = Calendar.getInstance();
        Date date = cal.getTime();

        StringRequest req = new StringRequest(Request.Method.POST, "http://beer.mokote.dk/resources/api/getMatchHistory.php", new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                System.out.println(response); //Debugging

                if(!response.equals("0 results")) {

                    JSONArray jArr;

                    List<Match> matchList = new ArrayList<>();
                    try {
                        jArr = new JSONArray(response);


                        for (int i = 0; i < jArr.length(); i++) {

                            JSONObject jObj = new JSONObject(jArr.getString(i));

                            Match m = new Match(
                                    new Date(),
                                    jObj.getInt("score1"),
                                    jObj.getInt("score2"),
                                    Arrays.asList(new Player(99991, "DummyPlayer1", 1501), new Player(99992, "DummyPlayer2", 1502)),
                                    Arrays.asList(new Player(99993, "DummyPlayer3", 1503), new Player(99994, "DummyPlayer4", 1504))
                            );

                            matchList.add(m);
                        }

                    } catch (JSONException e) {
                        e.printStackTrace();
                    }

                    MatchHistoryListAdapter adapter = new MatchHistoryListAdapter(MatchHistoryActivity.this, matchList);
                    historyList.setAdapter(adapter);
                }else{
                    // TODO tilføj resultat for "ingen tidlligere kampe"
                }

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                VolleyLog.e("error : " + error.getMessage());
            }
        }){
            @Override
            protected Map<String,String> getParams() throws AuthFailureError {
                Map<String,String> params = new HashMap<String, String>();
                params.put("id",String.valueOf(getIntent().getIntExtra("id",0))); // TODO Test for at default værdi ikke bliver brugt. Potentiale for lorteBug(c)

                return params;
            }
        };

        // add the request object to the queue to be executed
        ApplicationController.getInstance().addToRequestQueue(req);


    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_match_history, menu);
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

