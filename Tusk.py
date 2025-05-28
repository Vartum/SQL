from collections import defaultdict

# Считываем количество английских слов
n = int(input())

# Латинско-английский словарь
latin_to_english = defaultdict(set)

# Обрабатываем англо-латинский словарь
for _ in range(n):
    line = input()
    eng, latins_str = line.split(' - ')
    latins = latins_str.split(', ')
    for latin in latins:
        latin_to_english[latin].add(eng)

# Сортируем латинские слова
latin_words = sorted(latin_to_english.keys())

# Выводим латинско-английский словарь
print(len(latin_words))
for latin in latin_words:
    translations = sorted(latin_to_english[latin])
    print(f"{latin} - {', '.join(translations)}")
