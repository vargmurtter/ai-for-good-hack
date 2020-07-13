import telebot
import urllib.request
import json 


API_TOKEN = '[API_TOKEN]'
MS_ENDPOINT = 'http://maskshow.azurewebsites.net/api.php?key=90B794B4-2AE3-42EF-A147-71EB8AC0075B&img_url='

bot = telebot.TeleBot(API_TOKEN)


@bot.message_handler(content_types="photo")
def handle_photo(message):
    photo_url = "https://api.telegram.org/file/bot" + API_TOKEN + "/" + bot.get_file(message.photo[0].file_id).file_path
    
    print(photo_url)
    
    with urllib.request.urlopen(MS_ENDPOINT + photo_url) as url:
        data = json.loads(url.read().decode())
        
        counter = 0
        for result in data["result"]:
            if result["probability"] >= 0.8:
                print(result["probability"])
                counter += 1
        
        bot.send_message(message.chat.id, "На фото найдено масок: " + str(counter))
        
def handle_text(message):
    bot.send_message(message.chat.id, "Скинь фотку в маске или без :)")

bot.polling(none_stop=True)