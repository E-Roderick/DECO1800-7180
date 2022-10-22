# shape_id to trip_id - trips.txt
# trip_id to stop_ids - stop_times.txt
# stop_ids to latlon/stop name - stops.txt

# "61" => "610142",
# "66" => "660047",
# "111" => "1110001",
# "222" => "2220001",
# "444" => "4440002",
# "P206" => "P2060002",

from typing import List
import pandas as pd
import sys

FILE_TYPE = ".txt"

TARGETS = (
    "610142", "660047", "1110001", "2220001", "4440002", "P2060002"
)

def find_stop_information(targets: List[str]):
    """ Finds information relating to the bus routes provided. """
    for target in targets:
        # Load dataframes
        trips_df = pd.read_csv("data/trips.txt", dtype=str)
        stop_times_df = pd.read_csv("data/stop_times.txt", dtype=str)
        stops_df = pd.read_csv("data/stops.txt", dtype=str)

        # Get trips on the target route
        trip_df = trips_df[trips_df['shape_id'] == target]

        # Merge trip information with stop times
        trips_and_stop_times_df = stop_times_df.merge(trip_df, left_on="trip_id", right_on="trip_id")

        # Get all unique stop_ids for the trips on the target route
        stop_ids = trips_and_stop_times_df.stop_id.unique()

        # Get the stops for the unique stop_ids
        filtered_stops = stops_df[stops_df['stop_id'].isin(stop_ids)]

        result_df = filtered_stops[
            ["stop_id", "stop_lat", "stop_lon", "stop_name", "stop_url"]
        ]

        # Process the name to remove bad characters
        result_df["stop_name"] = result_df.loc[:,("stop_name")].copy().apply(
            lambda name: (name.strip('"').split(','))[0]
        )

        # Export result
        result_df.to_csv(f"{target}{FILE_TYPE}", index=False, header=None)
        print(f"Wrote stops file for {target}")


if __name__ == "__main__":

    if len(sys.argv) == 1:
        routes = TARGETS
    else:
        source = sys.argv[1]
        routes = sys.argv[2:]

    if not routes:
        raise ValueError("No routes provided")

    find_stop_information(routes)