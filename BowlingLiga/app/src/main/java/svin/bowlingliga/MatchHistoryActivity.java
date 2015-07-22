package svin.bowlingliga;

import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ListView;
import android.widget.TextView;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;

import svin.bowlingliga.ListAdapter.MatchHistoryListAdapter;
import svin.bowlingliga.Models.Match;
import svin.bowlingliga.Models.Player;


public class MatchHistoryActivity extends ActionBarActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_match_history);

        ListView historyList = (ListView)findViewById(R.id.matchHistoryListView);

        List<Player> homeTeamList = new ArrayList<>();
        List<Player> awayTeamList = new ArrayList<>();

        Player player1 = new Player(1, "Kasper T", 500);
        Player player2 = new Player(2, "Luffe", 500);
        Player player3 = new Player(3, "Svindreas", 500);
        Player player4 = new Player(4, "Pro l33t alekon the 3rd", 500);

        homeTeamList.add(player1);
        homeTeamList.add(player2);
        awayTeamList.add(player3);
        awayTeamList.add(player4);

        SimpleDateFormat formatter = new SimpleDateFormat("dd-MM-yyyy");

        Calendar cal = Calendar.getInstance();
        Date date = cal.getTime();

        Match match = new Match(date, 2, 5, homeTeamList, awayTeamList);
        Match match2 = new Match(date, 2, 5, awayTeamList, homeTeamList);
        List<Match> matchList = new ArrayList<>();
        matchList.add(match);
        matchList.add(match2);

        MatchHistoryListAdapter adapter = new MatchHistoryListAdapter(MatchHistoryActivity.this, matchList);
        historyList.setAdapter(adapter);

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
