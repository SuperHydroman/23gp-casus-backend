## 23GP – Casus Backend

Bij 23G wordt er fanatiek geracet op onze racesimulatoren. Bij een competitie
hoort ook een leaderboard. Het is jouw taak om een back-end API te bouwen.

Dit project bevat unit tests. Gebruik deze tests om te controleren of je de
opdracht hebt uitgewerkt zoals het zou moeten. Hieronder vind je de
requirements.

**Basisopdracht:**

1. Zorg dat er in de database een tabel komt om `drivers` op te opslaan.
    * Drivers hebben een `name` en een `team_name`. Beide velden zijn verplicht.
2. Zorg daarnaast dat er in de database een tabel komt om `results` op te slaan.
    * Results bestaan uit een `driver_id` en `circuit_name`; en rondetijden per
      sector: `sector_1`, `sector_2`, `sector_3`. Voeg als laatste ook nog een
      `lap_total` toe.
3. Voeg een `POST /results` endpoint toe waar je results mee op kunt slaan.
    * Valideer dat de sectortijden voldoen aan het formaat `29.823`.
    * Valideer dat de `lap_total` voldoet aan het formaat `01:23.032`.
    * Valideer dat de sectortijden en `lap_total` groter zijn dan `0`.
    * Geef een `201 Created` response terug met de inputdata in de volgende
      structuur:
      ```json
      {
          "data": {
              "driver": {
                  "name": "Max Verstappen",
                  "team_name": "Red Bull Racing"
              },
              "sector_1": 25.344,
              "sector_2": 25.704,
              "sector_3": 25.378,
              "lap_total": "01:16.427"
          }
      }
      ```
4. Voeg een `GET /results` endpoint toe waarmee de vijf snelste results mee kunnen
   worden opgehaald.
    * Sorteer op `lap_total` (laagste eerst).
    * Geef de volgende velden terug: `driver` (object met daarin `driver_name`,
      `team_name`), `sector_1`, `sector_2`, `sector_3` en `lap_total`.
