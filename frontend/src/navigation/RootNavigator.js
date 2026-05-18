import React from 'react';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import LoginScreen from '../screens/LoginScreen';
import MainShell from '../screens/MainShell';
import EvaluationFormScreen from '../screens/EvaluationFormScreen';
import AgreementScreen from '../screens/AgreementScreen';
import { useApp } from '../context/AppContext';

const Stack = createNativeStackNavigator();

export default function RootNavigator() {
  const { token } = useApp();
  return (
    <Stack.Navigator screenOptions={{ headerShown: false }}>
      {!token ? (
        <Stack.Screen name="Login" component={LoginScreen} />
      ) : (
        <>
          <Stack.Screen name="Agreement" component={AgreementScreen} />
          <Stack.Screen name="Main" component={MainShell} />
          <Stack.Screen name="EvaluationForm" component={EvaluationFormScreen} />
        </>
      )}
    </Stack.Navigator>
  );
}
