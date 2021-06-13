---
title: "Flutter Web Dependency"
date: 2021-06-13 14:26:28 +0900
categories: check
---

* There is some cases when flutter_web needs to overrides dependency.

dependency_overrides:
    flutter_web:
        path: ../../packages/flutter_web
    flutter_web_test:
        path: ../../packages/flutter_web_test
    flutter_web_ui:
        path: ../../packages/flutter_web_ui
