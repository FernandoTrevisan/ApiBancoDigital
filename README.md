<h1> Como usar localmente a API </h1>

* Importe o Banco de Dados via MySQL Workbench
* Abra a pasta do projeto no VS Code
* Inicialize o servidor do PHP: php -S 0.0.0.0:8000
* A inicialização é diferente pois estamos utilizando o Wild Card que possibilita o servidor interno do PHP a ser acessado a partir de outros hosts
* Deixe o Terminal aberto para acompanhar o log de saída e ver requisições bem-sucedidas status code 200

<h2> Configurações que devem ser feitas no app Xmarin/Maui </h2>

* Repositório do Aplicativo: https://github.com/FernandoTrevisan/AppBancoDigital
* Altere na DataService para: http://10.0.2.2:8000/Rota_desejada 
* Configure seu App Android para requisições inseguras sem https no arquivo AndroidManifest.xml:

  ```C#
  <application  android:usesCleartextTraffic="true" ... />
  ```
   
<h3> Exemplo de como ficará com a alteração </h3> 
   
```C#
<?xml version="1.0" encoding="utf-8"?>
<manifest xmlns:android="http://schemas.android.com/apk/res/android" android:versionCode="1" android:versionName="1.0" package="com.companyname.appbancodigital">
    <uses-sdk android:minSdkVersion="21" android:targetSdkVersion="31" />
    <application android:usesCleartextTraffic="true" android:label="AppBancoDigital.Android" android:theme="@style/MainTheme"></application>
    <uses-permission android:name="android.permission.ACCESS_NETWORK_STATE" />
</manifest>
```
