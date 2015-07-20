package svin.bowlingliga.ListAdapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.List;

import svin.bowlingliga.Models.Team;
import svin.bowlingliga.R;

// Custom list adapter for the list of causes in order to implement a custom-made setup for each item
public class TeamListAdapter extends BaseAdapter
{
    private LayoutInflater mInflater;
    private List<Team> teamList;

    public TeamListAdapter(Context context, List<Team> causes)
    {
        mInflater = LayoutInflater.from(context);
        teamList = causes;
    }

    @Override
    public int getCount()
    {
        return teamList.size();
    }

    @Override
    public Object getItem(int position)
    {
        return teamList.get(position);
    }

    @Override
    public long getItemId(int position)
    {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent)
    {
        View view;
        ViewHolder holder;
        if(convertView == null)
        {
            view = mInflater.inflate(R.layout.team_list_item, parent, false);
            holder = new ViewHolder();
            holder.teamName = (TextView)view.findViewById(R.id.teamName);
            holder.teamWins = (TextView)view.findViewById(R.id.teamWins);
            holder.teamLosses = (TextView)view.findViewById(R.id.teamLosses);
            holder.teamRating = (TextView)view.findViewById(R.id.teamRating);
            view.setTag(holder);
        } else
        {
            view = convertView;
            holder = (ViewHolder)view.getTag();
        }

        Team team = teamList.get(position);

        holder.teamName.setText(team.getTeamName());
        holder.teamWins.setText(String.valueOf(team.getTeamWins()));
        holder.teamLosses.setText(String.valueOf(team.getTeamLosses()));
        holder.teamRating.setText(String.valueOf(team.getTeamRating()));


        return view;
    }

    private class ViewHolder
    {
        public TextView teamName, teamWins, teamLosses, teamRating;
    }
}

