class HotelReservation:
    
    global hotels 
    
    hotels = {
        'green_valley' : {
            'rating' : 3,
            'regular' : {
                'weekday' : 1100,
                'weekend' : 900,
            },
            'rewards' : {
                'weekday' : 800,
                'weekend' : 800,
            }
        },
        'red_river' : {
            'rating' : 4,
            'regular' : {
                'weekday' : 1600,
                'weekend' : 600,
            },
            'rewards' : {
                'weekday' : 1100,
                'weekend' : 500,
            }
        },
        'blue_hills' : {
            'rating' : 5,
            'regular' : {
                'weekday' : 2200,
                'weekend' : 1500,
            },
            'rewards' : {
                'weekday' : 1000,
                'weekend' : 400,
            }
        }
    }

        
    def calculate_price(self,input):
    
        customer_type = input.split(": ")[0].lower().strip()
        later_date_part = input.split(": ")[1]
        individual_date = list(map(str, later_date_part.split(", ")))
    
        final_price_arr = {}
        green_valley_price = 0
        red_river_price = 0
        blue_hills_price = 0
    
        for i in individual_date:
            check_day = i.split("(")[1][:-1]
            if check_day == 'sat' or check_day == 'sun':
                day = 'weekend'
            else:
                day = 'weekday'
            
            green_valley_price += hotels['green_valley'][customer_type][day]
            red_river_price += hotels['red_river'][customer_type][day]
            blue_hills_price += hotels['blue_hills'][customer_type][day]
        
        final_price_arr['green_valley'] = green_valley_price
        final_price_arr['red_river'] = red_river_price
        final_price_arr['blue_hills'] = blue_hills_price
        
        min_value = min(final_price_arr.values())
        min_keys = [k for k in final_price_arr if final_price_arr[k] == min_value]
        
        max_value = {}
        for i in min_keys:
            max_value[i] = hotels[i]['rating']
            
        return max(max_value, key=max_value.get)
        

obj = HotelReservation()
cheapest_hotel = obj.calculate_price(input())

print("The cheapest hotel is: " + cheapest_hotel)


