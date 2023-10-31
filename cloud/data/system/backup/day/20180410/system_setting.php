<?php exit;?>{
    "systemPassword": "r8HxhJUnZxbDRkJP7dw8",
    "systemName": "讯幻网盘",
    "systemDesc": "网盘,讯幻网盘,网络U盘,网络硬盘,免费网盘,网盘下载,网盘资源",
    "pathHidden": "Thumb.db,.DS_Store,.gitignore,.git",
    "autoLogin": "0",
    "needCheckCode": "1",
    "firstIn": "explorer",
    "newUserApp": "trello,一起写office,微信,365日历,石墨文档,ProcessOn,计算器,icloud,OfficeConverter",
    "newUserFolder": "desktop,默认文件夹",
    "newGroupFolder": "share,doc,pictures",
    "desktopFolder": "desktop",
    "versionType": "A",
    "rootListUser": "0",
    "rootListGroup": 0,
    "csrfProtect": "1",
    "currentVersion": "KOD_VERSION",
    "menu": [
        {
            "name": "desktop",
            "type": "system",
            "url": "index.php?desktop",
            "target": "_self",
            "use": "1"
        },
        {
            "name": "explorer",
            "type": "system",
            "url": "index.php?explorer",
            "target": "_self",
            "use": "1"
        },
        {
            "name": "editor",
            "type": "system",
            "url": "index.php?editor",
            "target": "_self",
            "use": "1"
        }
    ],
    "pluginList": {
        "yzOffice": {
            "id": "yzOffice",
            "regiest": {
                "user.commonJs.insert": "yzOfficePlugin.echoJs"
            },
            "status": "1",
            "config": {
                "pluginAuth": "all:1",
                "openWith": "dialog",
                "fileExt": "doc,docx,docm,dot,dotx,dotm,rtf,wps,wpt,xls,xlsx,xlt,xlsm,csv,ppt,pptx,pps,ppsx",
                "fileSort": 50,
                "cacheFile": "1",
                "preview": "0"
            }
        },
        "officeLive": {
            "id": "officeLive",
            "regiest": {
                "user.commonJs.insert": "officeLivePlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1",
                "pluginAuthOpen": 0,
                "openWith": "dialog",
                "apiServer": "https:\/\/owa-box.vips100.com\/op\/view.aspx?src=",
                "fileExt": "doc,docx,docm,dot,dotx,dotm,rtf,xls,xlsx,xlt,xlsb,xlsm,csv,ppt,pptx,pps,ppsx,pptm,potm,ppam,potx,ppsm,odt,ods,odp,ott,ots,otp,wps,wpt",
                "fileSort": 5
            }
        },
        "VLCPlayer": {
            "id": "VLCPlayer",
            "regiest": {
                "user.commonJs.insert": "VLCPlayerPlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1",
                "fileExt": "aac,arc,arj,asf,asx,avi,f4v,flv, m2ts,m4v,mp2,mov,mp3,mp4,mp4v,mpe,mpg,mts,mkv,ogv,3gp,mpeg,wav,wma,wmv,rm,rmvb,vob,webm,webmv,   mp3,wav,wma,m4a,aac,oga,ogg,webma",
                "fileSort": 1
            }
        },
        "simpleClock": {
            "id": "simpleClock",
            "regiest": {
                "user.commonJs.insert": "simpleClockPlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1"
            }
        },
        "jPlayer": {
            "id": "jPlayer",
            "regiest": {
                "user.commonJs.insert": "jPlayerPlugin.echoJs"
            },
            "status": "1",
            "config": {
                "pluginAuth": "all:1",
                "fileExt": "mp3,wav,m4a,aac,oga,ogg,webma,mp4,m4v,flv,mov,f4v,ogv,webm,webmv",
                "fileSort": 10
            }
        },
        "photoSwipe": {
            "id": "photoSwipe",
            "regiest": {
                "user.commonJs.insert": "photoSwipePlugin.echoJs"
            },
            "status": "1",
            "config": {
                "pluginAuth": "all:1",
                "fileExt": "jpg,jpeg,png,bmp,gif,ico,svg,cur,webp",
                "fileSort": 20
            }
        },
        "zipView": {
            "id": "zipView",
            "regiest": {
                "user.commonJs.insert": "zipViewPlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1",
                "fileExt": "zip,tar,gz,tgz,ipa,apk,rar,7z,iso,bz2,zx,z,arj,epub",
                "fileSort": 10
            }
        },
        "adminer": {
            "id": "adminer",
            "regiest": {
                "templateCommonHeader": "adminerPlugin.addMenu"
            },
            "status": 1,
            "config": {
                "menuSubMenu": 1
            }
        },
        "picasa": {
            "id": "picasa",
            "regiest": {
                "user.commonJs.insert": "picasaPlugin.echoJs"
            },
            "status": "1",
            "config": {
                "pluginAuth": "all:1",
                "fileExt": "jpg,jpeg,png,bmp,gif,ico,svg,cur,webp",
                "fileSort": 10
            }
        },
        "toolsCommon": {
            "id": "toolsCommon",
            "regiest": {
                "user.commonJs.insert": "toolsCommonPlugin.echoJs"
            },
            "status": 1,
            "config": []
        },
        "googleDocs": {
            "id": "googleDocs",
            "regiest": {
                "user.commonJs.insert": "googleDocsPlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1",
                "fileExt": "doc,docx,rtf,xls,xlsx,wps,ppt,pptx,pps,.odt,ods,odp,ott,ots,otp,dxf,ps,eps,xps,psd,tif,tiff,bmp,svg,pages,ai,ttf",
                "fileSort": -1
            }
        }
    },
    "globalIcp": "湘ICP备17005202号-1",
    "globalCss": "",
    "globalHtml": ""
}