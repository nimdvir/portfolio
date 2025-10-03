
const ynetPlusRegex = /ynet\+/;

const PremiumResourceIDs = new Set(["BR6UBQMD", "BR6ZJXVR", "BRFT6AM7", "BRZYMV05", "BRV7Q7DK", "BRFIFUX9", "BR6JG464", "BR9JWA1I", "BROBJCTX", "BR941V52", "BR7A9GLU"]);

var YitPaywall = {
  user: null,
  LoginPopUp: null,
  platform: "desktop",
  LoginLink: null,
  userToken: "",
  isPianoLogin: true,
  piano_aid: "scyIGFmBpu",
  originWhiteList: [
    "qa.ynet.co.il",
    "qa-m.ynet.co.il",
    "qa2-m.ynet.co.il",
    "qa-pplus.ynet.co.il",
    "cel-test2.ynet.co.il",
    "mtest.pplus.ynet.co.il",
    "de-qav2.ynet.co.il",
  ],
  iphone: /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream,
  routesConfig: {
    loginPopUp: null,
    registerPage: null,
    premiumArticleUrlsPattern: {
      wcm: {
        free: "/articles",
        premium: "/articles/premium",
      },
      desktop: {
        free: "/articles",
        premium: "/articles/premium",
      },
      mobileweb: {
        free: "/articles",
        premium: "/articles/premium",
      },
      mobilewebpplus: {
        free: "/article.aspx",
        premium: "/premium/article.aspx",
      },
      iphone: {
        free: "/Html",
        premium: "/Html/premium",
      },
      android: {
        free: "/Html",
        premium: "/Html/premium",
      },
      tablet: {
        free: "/Html",
        premium: "/Html/premium",
      },
    },
  },
  ApiRroutesConfig: {
    Origin: "https://qa-primium.ynet.co.il",
    serverSession: "/paywall/login",
    serverSessionLogout: "/paywall/logout",
    logout: "/paywall/logout",
  },
  Constructor: function () {
    (function (src) {
      var a = document.createElement("script");
      a.type = "text/javascript";
      a.async = true;
      a.src = src;
      var b = document.getElementsByTagName("script")[0];
      b.parentNode.insertBefore(a, b)
    })("//experience.tinypass.com/xbuilder/experience/load?aid=" + YitPaywall.piano_aid);

    return this;
  },
  logoutUser: function () {
    if (tp.pianoId.isUserValid()) {
      tp.pianoId.logout(() => {
        localStorage.removeItem("piano_user");
        location.reload();
      });
    }
  },
  httpGet: function (theUrl, method, callback) {
    this.logoutUser();
  },

  openLoginPopUp: function (url, options) {
    tp.push([
      "init",
      () => {
        tp.pianoId.show({
          screen: "login"
        });
      },
    ]);
  },
  InfrastructureInitialize: function () {
    this.user = { props: { user_type: "GUEST" } };
    const pianoUserObj = JSON.parse(localStorage.getItem("piano_user"));
    if (pianoUserObj !== null) {
      this.user = { props: { ...pianoUserObj } };
    } else {
      try {
        tp.push(["init", function () {
          tp.pianoId.init({
            loggedIn: function (data) {
              this.user = { props: { ...data.user, userId: data.user.uid, "piano_id": data.user.uid } };
              const login_data = data;
              tp.api.callApi("/access/check/", {
                rid: "ROFITOA"
              }, function (data) {
                console.log("access check data: ", data)
                if (!data.access.granted) {
                  tp.api.callApi("/conversion/registration/create", {
                    term_id: "TMA33EHKGX5D"
                  }, function (data) {

                    if (tp.customVariables.register_flow) {
                        reportFlow(data);
                      }
  
                    console.log("User granted access to Ynet+ Free Registratin: ", data)
                    setUserType(login_data);
                  });
                } else {
                  setUserType(login_data);
                }
              });

              function reportFlow(data) {
                let trackingId = tp.customVariables.trackingId;
                let termId = data.conversion.term.term_id;
                let termName = data.conversion.term.resource.name;
                let conversion_category = data.conversion.type;
                tp.log.logConversion(trackingId, termId, termName, "", "", "", "", conversion_category)

              }

              function setUserType(data) {
                tp.api.callApi("/access/list", {}, (response) => {
                  this.user = { props: { ...this.user.props, user_type: "REGISTERED" } };
                  response.data.forEach(activeResource => {
                    if (PremiumResourceIDs.has(activeResource.resource.rid)) {
                      this.user = { props: { ...this.user.props, user_type: "SUBSCRIBED" } };
                    }
                  })
                  localStorage.setItem("piano_user", JSON.stringify(this.user.props));
                  redirect(data);
                });
              }


              function redirect(data) {
                if (data.source !== "OFFER") {
                  const currentURL = window.location.href;
                  const register_flow = tp && tp.customVariables.register_flow;
                  if (currentURL.includes("ynet.co.il/plus/packages") || data.stage === 'lp_flow' && !register_flow ) {
                    return window.location.href = "https://www.ynet.co.il/plus/";
                  }

                  if (register_flow) {
                    let mainSiteContainer;
                    if (data.stage === 'register_flow') {
                        mainSiteContainer = document.querySelector('#site_container .articleContainer');
                      } else if (data.stage === 'lp_flow') {
                        mainSiteContainer = document.querySelector('#lp-container #inner-premium-block-container');
                      }                                          
                    mainSiteContainer && mainSiteContainer.classList.add('thanks-screen');
                    if (data.stage === 'register_flow' || data.stage === 'lp_flow') {
                        tp.push(["init", function () {
                            tp.offer.show({ displayMode: 'inline', containerSelector: '#inner-premium-block-container', templateId: 'OT9S9YN057BV', offerId: 'OFM86K09GKGV' });
                        }])
                    } else if (data.stage === 'register_flow_b') {
                        tp.push(["init", function () {
                            tp.offer.show({ displayMode: 'inline', containerSelector: '#inner-premium-block-container', templateId: 'OT9S9YN057BV', offerId: 'OFM86K09GKGV' });
                        }])
                    }

                } else {
                    location.reload();
                  }   
                  }
              }

            },
            registrationSuccess: function (data) {
              if (data.registration && data.source === 'PIANOID' && (data.stage === 'register_flow_b' || data.stage === 'register_flow' || data.stage === 'lp_flow')) {
                tp.setCustomVariable("register_flow", true)
              }
            }
          });
        }]);
      } catch (error) {
        console.log(error)
      }
    }

  },
};

window.tp = window.tp || [];
YitPaywall.Constructor();
YitPaywall.InfrastructureInitialize();