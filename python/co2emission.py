from requests.auth import HTTPBasicAuth
import requests
import json
from concurrent.futures import ThreadPoolExecutor
import haversine as hs
from haversine import Unit
from geopy.geocoders import Nominatim


userid = 'hackzurich2020'
pwd = 'uhSyJ08KexKn4ZFS'



def get(url, **kwargs):
    response = requests.get(url, auth=(userid, pwd), **kwargs)
    if not response.ok:
        print('response not ok!')
    return response.json()

def represents_int(s):
    '''
    get rid of elements with non-digit characters
    '''
    try: 
        int(s)
        return True
    except ValueError:
        return False

def query_co2_data(article_id):
    query = {}
    url = f'https://hackzurich-api.migros.ch/hack/logistic/orders?articleID={article_id}'
    output = get(url)
    if not output:
        pass
        #print(f'No transport data for {article_id}')
    try:
        query = {
            'article': output[0]['artikel'],
            'country': output[0]['lieferant_land'],
            'transporttyp': output[0]['transporttyp'],
            'city': output[0]['lieferant_ort']
        }
    except:
        query = {
            'article': None,
            'country': None,
            'transporttyp': None,
            'city': None
        }
    #print(json.dumps(query, indent=2))
    return query

def start_threads(article_ids):
    amount = len(article_ids)
    #print(f'number of product ids: {amount}')
    with ThreadPoolExecutor(max_workers=2000) as executor:
        for article_id in article_ids:       
            true = represents_int(article_id)
            if true:
                executor.submit(query_co2_data, article_id)
            else:
                pass    

def _get_product_ids():
    all_product_ids = []
    new_results = True
    offset = 2000
    #while new_results:
    while offset != 2000:
        url = f'https://hackzurich-api.migros.ch/products?&verbosity=id&limit=2000&offset={offset}'
        product_ids = requests.get(url, auth=HTTPBasicAuth(userid, pwd))
        product_ids = product_ids.json()
        try:
            product_ids = product_ids['ids']
        except:
            pass
        amount = len(product_ids)
        print(f'Anzhal ids: {amount}')
        try:
            all_product_ids.append(product_ids)
        except:
            pass
        offset += 2000
    all_product_ids = all_product_ids[0]
    with open('all_product_ids.txt', 'w') as file:
        file.write(json.dumps(all_product_ids))
    return all_product_ids

def product_info(product_id):
    url = f'https://hackzurich-api.migros.ch/products/{product_id}?view=browse&verbosity=full&custom_image=false'
    response = requests.get(url, auth=HTTPBasicAuth(userid, pwd))
    product_info = response.json()
    print(json.dumps(product_info, indent=2))

def city_to_coordinates(city):
    coordinates = []
    geolocator = Nominatim(user_agent="http")
    location = geolocator.geocode(city)
    coordinates.append(location.latitude)
    coordinates.append(location.longitude)
    return coordinates

def location_distance(loc1, loc2):
    #To calculate distance in meters
    print(f'{loc1} to {loc2}') 
    loc1 = city_to_coordinates(loc1)
    loc2 = city_to_coordinates(loc2)
    distance = hs.haversine(loc1,loc2,unit=Unit.KILOMETERS)
    distance = round(distance)
    return distance

def co2_emissions(distance, transporttyp):
    transporttyp = transporttyp.lower()
    if transporttyp == 'sea':
        emissions = int(distance)* int(15)              #'15g/tkm'x1
    if transporttyp == 'rail':
        emissions = int(distance)* int(30)              #'30g/tkm'x2
    if transporttyp == 'trucking':
        emissions = int(distance)* int(70)              #'70g/tkm' x4.5
    if transporttyp == 'air':
        emissions = int(distance)* int(800)             #'800g/tkm' x15
    else:
        pass
    return emissions
    
def co2footprint():
    #article_ids = _get_product_ids()
    location = query_co2_data('881620110442')
    distance = location_distance(location['city'], 'zurich')
    transporttyp = location['transporttyp'].lower()
    emissions = co2_emissions(distance, transporttyp)
    if transporttyp == 'sea':
        footprint = 'ok'
        print(f'{emissions} g/tkm by {transporttyp} is {footprint}')
    if transporttyp == 'air':
        footprint = 'bad'
        print(f'{emissions} g/tkm by {transporttyp} is {footprint}')

if __name__ == "__main__":
    co2footprint()

    