import sys
import pandas as pd

ID = "shape_id"
LAT = "shape_pt_lat"
LON = "shape_pt_lon"

FILE_TYPE = ".txt"

def get_route(target_route) -> pd.DataFrame:
    """ Search the shapes data and return a dataframe containing the latlong of
    a target route.
    """
    shapes = pd.read_csv("shapes.txt", dtype={ID: str})
    shapes = shapes[shapes[ID] == target_route]
    shapes = shapes[[LAT, LON]]
    return shapes

if __name__ == "__main__":

    if len(sys.argv) == 1:
        print("Usage: get_route.py <shape_source_path> <route_id> [extra route_ids]")
        exit()

    source = sys.argv[1]
    routes = sys.argv[2:]

    if not routes:
        raise ValueError("No routes provided")

    for target_route in routes:
        print(f"\nCreating route file for {target_route}...")

        route = get_route(target_route)
        print(route.head(2)) # Print for confirmation
        route.to_csv(f"{target_route}{FILE_TYPE}", index=False, header=None)