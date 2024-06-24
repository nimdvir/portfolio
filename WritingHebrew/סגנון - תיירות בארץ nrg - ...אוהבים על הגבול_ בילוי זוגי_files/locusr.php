<!doctype html><html><head><meta charset="utf-8"><script type="text/javascript" src="/kramericaindustries.ac.lib.js"></script><script type="text/javascript">
;;window.rbzns={"bereshit":"1","seed":"C5Q2Fszwg2z4pRgm0j\/gicUONt+6PM+BKjikvRN45Je4PSySB2WuFsYo0MFmLwzqRTFr0L7VvKNkbZARo2FpseHBsFRTKCsI7PXrpnweI25a4otNqUGyKeWmb1t\/t4WO7bc+7cPnX6453uL6A2usz8GIV7MQJczy80anZ+VNoJAFgZvXgiKe3DguZlP0E3+4+a9A5y7ZiJLpYI\/4GoxUklXuMQutQx4zxAmk+hGR168=","location_host":"www.makorrishon.co.il","storage":3,"protocol":"https:"};winsocks();</script></head><body><script type="text/javascript">
  window.Zephr = window.Zephr || {};
  window.Zephr.includeOutcomes = true;
  window.Zephr.outcomesAsEvents = true;
  window.Zephr.groupFields = false;
(function() {
    var xhr = new(XMLHttpRequest || ActiveXObject)('MSXML2.XMLHTTP.3.0');
    xhr.open('GET', '/blaize/datalayer', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            var response;
            try {
                response = JSON.parse(xhr.response);
            } catch (e) {
                response = xhr.response;
            }
            if (xhr.status === 200) {
                for (var dataLayerFieldName in response) {
                    if (!(dataLayerFieldName in window)) window[dataLayerFieldName] = [];

                    var pageView = response[dataLayerFieldName];
                    var events = [];

                    if (window.Zephr && window.Zephr.includeOutcomes && window.Zephr.outcomes) {
                        pageView.zephrOutcomes = window.Zephr.outcomes;

                        if (window.Zephr.outcomesAsEvents) {
                            Object.keys(window.Zephr.outcomes || []).forEach(function(outcomeKey) {
                                var outcomeEvent = {
                                    event: "zephr-outcome-" + outcomeKey,
                                    featureId: outcomeKey,
                                    featureLabel: window.Zephr.outcomes[outcomeKey].featureLabel,
                                    outcomeId: window.Zephr.outcomes[outcomeKey].outcomeId,
                                    outcomeLabel: window.Zephr.outcomes[outcomeKey].outcomeLabel,
                                };
                                events.push(outcomeEvent);
                            });
                        }
                    }
                    if (window.Zephr && window.Zephr.accessDetails) {
                        Object.keys((window.Zephr.accessDetails.trials || {})).forEach(function(trialId){
                            var trial = window.Zephr.accessDetails.trials[trialId]
                            if(trial.reportInDataLayer){
                                var usedCredits = trial.totalCredits - trial.remainingCredits
                                if (window.Zephr.groupFields && !pageView.zephrTrials) pageView.zephrTrials = {};
                                var target = window.Zephr.groupFields ? pageView.zephrTrials : pageView
                                if (trial.dataLayerCreditsUsedKey) {
                                   target[trial.dataLayerCreditsUsedKey] = usedCredits;
                                }
                                if (trial.dataLayerCreditsRemainingKey) {
                                   target[trial.dataLayerCreditsRemainingKey] = trial.remainingCredits;
                                }
                            }
                        });
                        (window.Zephr.accessDetails.trialTrackingDetails || []).forEach(function(details) {
                            var type = details.entitlementType === 'credits' ? 'credits' : 'meters';
                            var trial = (window.Zephr.accessDetails[type] || {})[details.entitlementId];
                            if (!trial) return;
                            if (window.Zephr.groupFields && !pageView.zephrTrials) pageView.zephrTrials = {};
                            if (details.creditsRemainingKey) {
                                if (window.Zephr.groupFields) {
                                    pageView.zephrTrials[details.creditsRemainingKey] = trial.remainingCredits;
                                } else {
                                    pageView[details.creditsRemainingKey] = trial.remainingCredits;
                                }
                            }
                            if (details.creditsUsedKey) {
                                if (window.Zephr.groupFields) {
                                    pageView.zephrTrials[details.creditsUsedKey] = trial.totalCredits - trial.remainingCredits;
                                } else {
                                    pageView[details.creditsUsedKey] = trial.totalCredits - trial.remainingCredits;
                                }
                            }
                        });
                        try {
                          (Object.keys(window.Zephr.accessDetails.timeTrials || {})).forEach(function(timeTrialId) {
                               var timeTrial = window.Zephr.accessDetails.timeTrials[timeTrialId]
                               if(timeTrial.reportInDataLayer){
                                   if (window.Zephr.groupFields && !pageView.zephrTrials) pageView.zephrTrials = {};
                                   var target = window.Zephr.groupFields ? pageView.zephrTrials : pageView

                                   if (timeTrial.dataLayerTrialDurationKey) {
                                    target[timeTrial.dataLayerTrialDurationKey] = timeTrial.trialDuration;
                                   }
                                   if (timeTrial.dataLayerTrialDurationUnitsKey) {
                                    target[timeTrial.dataLayerTrialDurationUnitsKey] = timeTrial.trialDurationUnits;
                                   }
                                   if (timeTrial.dataLayerTrackerEntryTimeKey) {
                                    target[timeTrial.dataLayerTrackerEntryTimeKey] = timeTrial.entryTime;
                                   }
                                   if (timeTrial.dataLayerTrackerHitsKey) {
                                    target[timeTrial.dataLayerTrackerHitsKey] = timeTrial.trackerHits;
                                   }
                                   if (timeTrial.dataLayerTrialTimeRemainingKey) {
                                    target[timeTrial.dataLayerTrialTimeRemainingKey] = timeTrial.timeRemainingInTrial;
                                   }
                               }
                          });
                        } catch (err) {
                          console.error("Error aggregating Zephr time trials", err);
                        }
                    }
                    if (Object.keys(pageView).length) {
                        pageView.event = "zephr-pageview";
                        events.unshift(pageView);
                    }
                    if (!events.length) continue;

                    events.forEach(function(event) {
                        window[dataLayerFieldName].push(event);
                    });
                }
                var readyEvent = document.createEvent('Event');
                readyEvent.initEvent('zephr.dataLayerReady', true, true);
                document.dispatchEvent(readyEvent);
            }
        }
    }
    xhr.send({});
})();
</script>
<script type="text/javascript">
  if (!window.Zephr) window.Zephr = {};
  window.Zephr.accessDetails = {"isAuthenticated":false,"accessDecisions":{},"entitlements":{},"credits":{},"meters":{},"trials":{},"timeTrials":{},"trialTrackingDetails":[],"testGroups":{"6fd8cba5-f9b3-48e6-91e8-dab9d762f581":"B","bbf2a84e-1875-4141-9cfa-54f0c93b157f":"A","ab3396e5-0339-4771-807d-66146bd5e973":"B"},"activeProducts":[]};
</script>
</body></html>
