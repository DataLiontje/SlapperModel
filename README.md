# SlapperModels
Poggit: [![](https://poggit.pmmp.io/shield.state/SlapperModels)](https://poggit.pmmp.io/p/SlapperModels)

Slapper Addon plugin to add custom models to your slapper humans.

### Commands
| Command | Description | Permission |
| --- | --- | --- |
| /setslappermodel <modelname\> | Add model to Slapper Human | sm.command.setslappermodel |

### Permissions:
| Permission | Description | default |
| --- | --- | --- |
| slappermodels.command.setslappermodel | Access to the /setslappermodel command | OP |

### How to use this plugin

- Put Bedrock model json file into the Models folder in the plugin_data/SlapperModels folder

- Put Texture png file into the Textures folder in the plugin_data/SlapperModels folder

- For example we add a Cat that is named: "ExampleCat" and our Texturefile is called: "ExampleCat.png" and our geometry/model file is called: "ExampleCat.json".<br>
  We add these lines to "models.json". (located in the plugin_data folder of this plugin)<br>
  geometry_identifier can be found in your geometry/model json file;
  ```json
  {
      "Name": "ExampleCat",
      "geometry_file": "ExampleCat.json",
      "geometry_identifier": "geometry.examplecat",
      "texture_file": "ExampleCat.png"
    }
  ```
  So our new "models.json" would look like this.
  
  ```json
    [
      {
        "Name": "ExampleDog",
        "geometry_file": "ExampleDog.json",
        "geometry_identifier": "geometry.exampledog",
        "texture_file": "ExampleDog.png"
      },
      {
        "Name": "ExampleCat",
        "geometry_file": "ExampleCat.json",
        "geometry_identifier": "geometry.examplecat",
        "texture_file": "ExampleCat.png"
      }
    ]

  ```
  Now you can spawn your Human entity with: `/slapper spawn human <name\>`.<br>
  You can use: `/setslappermodel ExampleCat` now and click on the slapper human you created earlier.
 
  
